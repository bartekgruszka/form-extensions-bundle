<?php

namespace spec\FSi\Bundle\FormExtensionsBundle\DependencyInjection\Compiler;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class TwigFormPassSpec extends ObjectBehavior
{
    function it_is_compiler_pass()
    {
        $this->shouldImplement('Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface');
    }

    function it_do_nothing_when_form_resources_are_missing(ContainerBuilder $container)
    {
        $container->hasParameter('twig.form.resources')->shouldBeCalled()->willReturn(false);
        $this->process($container)->shouldReturn(null);
    }

    function it_add_ckeditor_form_layout_to_form_resources_param(ContainerBuilder $container)
    {
        $container->hasParameter('twig.form.resources')->shouldBeCalled()->willReturn(true);
        $container->getParameter('twig.form.resources')->shouldBeCalled()->willReturn(array());

        $container->setParameter('twig.form.resources', array('@FSiFormExtensions/Form/form_ckeditor_layout.html.twig'))
            ->shouldBeCalled();

        $this->process($container)->shouldReturn(null);
    }
}
