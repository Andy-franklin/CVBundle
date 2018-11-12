<?php

namespace AndyFranklin\CVBundle\Command;

use AndyFranklin\CVBundle\DataManager\CVInfo;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class CreateCVStaticPageCommand extends ContainerAwareCommand
{
    /**
     * @var Finder
     */
    private $finder;
    /**
     * @var \Twig_Environment
     */
    private $twigEnvironment;
    /**
     * @var CVInfo
     */
    private $CVInfo;

    /**
     * CVTemplateListCommand constructor.
     * @param Finder $finder
     * @param \Twig_Environment $twigEnvironment
     */
    public function __construct(Finder $finder, \Twig_Environment $twigEnvironment, CVInfo $CVInfo)
    {
        parent::__construct();
        $this->finder = $finder;
        $this->finder
            ->directories()
            ->depth('== 0')
            ->sortByChangedTime();
        $this->twigEnvironment = $twigEnvironment;
        $this->CVInfo = $CVInfo;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('afcv:generate:html')
            ->setDescription('Generate a static html page version of your CV.')
            ->addArgument('template', InputArgument::REQUIRED, 'Which template do you want to use? Run afcv:list:templates to see the list.');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //Ensure valid template name given
        $template = $input->getArgument('template');
        $availableTemplates = $this->getAvailableTemplates();

        if (!\in_array($template, $availableTemplates, true)) {
            throw new \RuntimeException('The template must be one listed by afcv:list:templates');
        }

        //Render twig
        $renderedDom = $this->twigEnvironment->render('@AndyFranklinCV/'. $template .'/index.html.twig', [
            'cvInfo' => $this->CVInfo
        ]);

        try {
            $file = fopen($template.'.html', 'wb');
            fwrite($file, $renderedDom);
            fclose($file);
            $output->writeln('Template written to file: ' . $template . '.html');
        } catch (\Exception $exception) {
            $output->writeln('Something went wrong writing to the file: ' . $exception->getMessage());
        }
    }

    private function getAvailableTemplates(): array
    {
        $templates = [];
        /** @var SplFileInfo $directory */
        foreach ($this->finder->in(__DIR__ . '/../Resources/views') as $directory) {
            $templates[] = $directory->getRelativePathname();
        }

        return $templates;
    }
}
