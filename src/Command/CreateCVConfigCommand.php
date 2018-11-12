<?php

namespace AndyFranklin\CVBundle\Command;

use AndyFranklin\CVBundle\DataManager\CVInfo;
use AndyFranklin\CVBundle\DataManager\Experience;
use AndyFranklin\CVBundle\DataManager\Interest;
use AndyFranklin\CVBundle\DataManager\Skill;
use AndyFranklin\CVBundle\DataManager\SocialLink;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Serializer\Encoder\YamlEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class CreateCVConfigCommand extends ContainerAwareCommand
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * CreateCVConfigCommand constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $normalizers = [new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter())];
        $encoders = [new YamlEncoder(null, null, ['yaml_inline' => 1, 'yaml_indent' => 4])];
        $this->serializer = new Serializer($normalizers, $encoders);
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('afcv:generate:config')
            ->setDescription('Generate your configuration YAML with this tool.');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'CV Config Creator',
            '-----------------',
            '',
        ]);

        $questionHelper = $this->getHelper('question');
        $CVInfo = new CVInfo();

        $output->writeln('Enter your basic details');

        $basicQuestions = [
            'name' => new Question('Name: '),
            'jobTitle' => new Question('Job Title: '),
            'workPlace' => new Question('Work Place: '),
            'summary' => new Question('Single Paragraph Summary: '),
        ];

        $answers = [];
        /**
         * @var string $key
         * @var Question $question
         */
        foreach ($basicQuestions as $key => $question) {
            $this->setNotEmptyValidator($question);
            $answers[$key] = $questionHelper->ask($input, $output, $question);
        }

        //Initialize CVInfo object
        $CVInfo
            ->setName($answers['name'])
            ->setJobTitle($answers['jobTitle'])
            ->setWorkPlace($answers['workPlace'])
            ->setSummary($answers['summary'])
        ;
        $output->writeln('');

        $output->writeln('Enter your social links');
        $typeQuestion = new Question('Social type (eg. LinkedIn): ');
        $linkQuestion = new Question('Social Link: ');
        $this->setNotEmptyValidator($typeQuestion);
        $this->setNotEmptyValidator($linkQuestion);
        do {
            $type = $questionHelper->ask($input, $output, $typeQuestion);
            $link = $questionHelper->ask($input, $output, $linkQuestion);
            $CVInfo->addSocialLink(new SocialLink($type, $link));
        } while ($this->isContinue($input, $output, $questionHelper));
        $output->writeln('');

        $output->writeln('Enter your work experiences');
        $titleQuestion = new Question('Title: ');
        $descriptionQuestion = new Question('Description: ');
        $this->setNotEmptyValidator($titleQuestion);
        $this->setNotEmptyValidator($descriptionQuestion);
        do {
            $title = $questionHelper->ask($input, $output, $titleQuestion);
            $description = $questionHelper->ask($input, $output, $descriptionQuestion);
            $CVInfo->addExperience(new Experience($title, $description));
        } while ($this->isContinue($input, $output, $questionHelper));
        $output->writeln('');

        $output->writeln('Enter your skills');
        do {
            $title = $questionHelper->ask($input, $output, $titleQuestion);
            $description = $questionHelper->ask($input, $output, $descriptionQuestion);
            $CVInfo->addSkill(new Skill($title, $description));
        } while ($this->isContinue($input, $output, $questionHelper));
        $output->writeln('');

        $output->writeln('Enter your interests');
        do {
            $title = $questionHelper->ask($input, $output, $titleQuestion);
            $description = $questionHelper->ask($input, $output, $descriptionQuestion);
            $CVInfo->addInterest(new Interest($title, $description));
        } while ($this->isContinue($input, $output, $questionHelper));
        $output->writeln('');

        $yamlSerialised = "andy_franklin_cv:\n" . $this->serializer->serialize($CVInfo, 'yaml');
        $fileSystem = new Filesystem();
        try {
            $fileSystem->appendToFile('andy_franklin_cv.yaml', $yamlSerialised);
            $output->writeln('Configuration file saved at '.__DIR__.'/andy_franklin_cv.yaml');
        } catch (\Exception $exception) {
            $output->write($exception->getMessage());
        }
    }

    private function isContinue(InputInterface $input, OutputInterface $output, QuestionHelper $questionHelper): bool
    {
        $question = new ConfirmationQuestion('Add another? (y/n) ', false);
        return $questionHelper->ask($input, $output, $question);
    }

    private function setNotEmptyValidator(Question $question): void
    {
        $question->setValidator(function ($answer) {
            if (null === $answer || !\is_string($answer) || trim($answer) === '') {
                throw new \RuntimeException('The value cannot be empty.');
            }
            return $answer;
        });
    }
}
