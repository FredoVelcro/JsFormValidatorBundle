<?php

namespace Fp\JsFormValidatorBundle\Twig\Extension;

use Symfony\Component\Form\Form;
use Fp\JsFormValidatorBundle\Factory\JsFormValidatorFactory;

/**
 * Class JsFormValidatorTwigExtension
 *
 * @package Fp\JsFormValidatorBundle\Twig\Extension
 */
class JsFormValidatorTwigExtension extends \Twig_Extension
{
    /**
     * @var JsFormValidatorFactory
     */
    protected $factory;

    /**
     * @return JsFormValidatorFactory
     * @codeCoverageIgnore
     */
    protected function getFactory()
    {
        return $this->factory;
    }

    /**
     * @param JsFormValidatorFactory $factory
     *
     * @codeCoverageIgnore
     */
    public function __construct(JsFormValidatorFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            'fp_jsfv' => new \Twig_Function_Method($this, 'getJsValidator', array('is_safe' => array('html'))),
        );
    }

    /**
     * @param Form $form
     *
     * @return string
     */
    public function getJsValidator(Form $form)
    {
        $model = $this->getFactory()->createJsModel($form);

        return "<script type=\"text/javascript\">FpJsFormValidatorFactory.initNewModel(" . $model . ')</script>';
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     * @codeCoverageIgnore
     */
    public function getName()
    {
        return 'fp_js_form_validator';
    }
}
