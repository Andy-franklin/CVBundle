<?php

namespace AndyFranklin\CVBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class CVTemplateListCommand extends ContainerAwareCommand
{
    /**
     * @var Finder
     */
    private $finder;

    /**
     * CVTemplateListCommand constructor.
     * @param Finder $finder
     */
    public function __construct(Finder $finder)
    {
        parent::__construct();
        $this->finder = $finder;
        $this->finder
            ->directories()
            ->depth('== 0')
            ->sortByChangedTime();
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('afcv:list:templates')
            ->setDescription('List the templates available to be used as an argument with the afcv:generate:html command');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var SplFileInfo $directory */
        foreach ($this->finder->in(__DIR__ . '/../Resources/views') as $directory) {
            $output->writeln($directory->getRelativePathname());
        }
    }
}
