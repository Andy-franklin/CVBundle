# CVBundle

Provides a simple extendable base for generating a CV page.

## Usage

### Installation

```bash
composer require andy-franklin/cv-bundle
```

Enable the bundles in your `bundles.php` file.

```php
AndyFranklin\CVBundle\AndyFranklinCVBundle::class => ['all' => true],
```

### Configuration
    
Using the command to generate this configuration for you 
```bash
php bin/console afcv:generate:config
```
    
or modifying the configuration by hand

```yaml
# config/packages/andy_franklin_cv.yaml
andy_franklin_cv:
   name: 'Andy Franklin'
   job_title: 'Web Developer'
   work_place: 'The Drum'
   summary: 'Experienced Web Developer with a demonstrated history of working in the publishing industry. Skilled in PHP, MySql, Symfony, HTML, CSS, JavaScript and Teamwork. Strong engineering professional with a BSc Web and Mobile Development (Hons) from The University of the West of Scotland.'
   social_links:
       - { type: 'github', link: 'https://github.com/Andy-franklin' }
       - { type: 'email', link: 'cv@andyfranklin.co.uk' }
       - { type: 'linkedIn', link: 'https://www.linkedin.com/in/andy-franklin-28854680/' }
   experience:
       - { title: 'experience one', description: 'description of experience one' }
       - { title: 'experience two', description: 'description of experience two' }
   skills:
       - { title: 'skill one', description: 'description of skill one' }
       - { title: 'skill two', description: 'description of skill two' }
   interests:
       - { title: 'interest one', description: 'description of interest one' }
       - { title: 'interest two', description: 'description of interest two' }
```

### See available templates
To see the available templates run the command
```bash
php bin/console afcv:list:templates
```


### Serve the page through Symfony
Using the output from the list command, pass the template name to the indexAction
```yaml
# config/routes.yaml
index:
    path: /
    controller: AndyFranklin\CVBundle\Controller\DefaultController::indexAction
```

### Or, Generate a single HTML page to host elsewhere

Using the output from the list command, pass the template name as an argument to the generate:html command.

```bash
php bin/console afcv:generate:html <template_name>
```

## Contributing

This bundle relies on having templates contributed for others to use.

### Template Guide

If you wish to add to the collection, contribute your twig files in their own folder with the desired template name.
Name the entry point of your template `index.html.twig` within your new template folder.

Include all custom styles and scripts in the twig template to be rendered to a single html file. 
Use of CDN or external styles and scripts is fine.

## License

MIT
