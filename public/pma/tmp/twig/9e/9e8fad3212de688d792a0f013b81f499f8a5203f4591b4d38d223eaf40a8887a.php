<?php

/* config/form_display/errors.twig */
class __TwigTemplate_d46cf9278b9e342216d161ffebeecf1ea507552150b5f0a4e740542306282eba extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<dl>
    <dt>";
        // line 2
        echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
        echo "</dt>
    ";
        // line 3
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["error_list"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
            // line 4
            echo "        <dd>";
            echo twig_escape_filter($this->env, $context["error"], "html", null, true);
            echo "</dd>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 6
        echo "</dl>
";
    }

    public function getTemplateName()
    {
        return "config/form_display/errors.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  39 => 6,  30 => 4,  26 => 3,  22 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "config/form_display/errors.twig", "/app/pma/templates/config/form_display/errors.twig");
    }
}
