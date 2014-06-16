In order to use the module:

composer.phar require clubmaster/formextra

When installed add the following to your AppKernel.php file:

new Club\FormExtrabundle\ClubFormExtrabundle(),

If you want to use the forms, remember to add this to your config.yml:

# Twig Configuration
twig:
    debug:            "%kernel.debug%"
    strict_variables: "%kernel.debug%"
    form:
        resources:
            - "ClubFormExtraBundle:Default:fields.html.twig"

Remember if you use the tinymce form, you will properly want to disble form validation:

<form novalidate="true">

Added html slider:

<ul id="slideshow">
    <li class="active">Demo 1</li>
    <li>Demo 2</li>
    <li>Demo 3</li>
</ul>

<link href="bundles/clubformextra/css/slideshow.css" />
<script src="bundles/clubformextra/js/slideshow.css"></script>

That will add a slideshow for you.
