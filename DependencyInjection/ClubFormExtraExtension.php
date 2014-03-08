<?php

namespace Club\FormExtraBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ClubFormExtraExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        $loader->load('twig.yml');
        $loader->load('form.yml');

        $container->setParameter('club_form_extra.title', $config['title']);
        $container->setParameter('club_form_extra.description', $config['description']);
        $container->setParameter('club_form_extra.tinymce_height', $config['tinymce_height']);
        $container->setParameter('club_form_extra.tinymce_width', $config['tinymce_width']);
        $container->setParameter('club_form_extra.tinymce_language_url', $config['tinymce_language_url']);
        $container->setParameter('club_form_extra.datepicker_firstday', $config['datepicker_firstday']);
    }
}
