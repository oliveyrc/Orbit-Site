<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* @help_topics/language.detect.html.twig */
class __TwigTemplate_d0cbdc9315824f09ac5d6976a3793a8a extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->extensions[SandboxExtension::class];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 7
        $context["detection_text"] = ('' === $tmp = implode('', iterator_to_array((function () use (&$context, $macros, $blocks) {
            yield t("Detection and selection", []);
            yield from [];
        })(), false))) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 8
        $context["detection_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink(($context["detection_text"] ?? null), "language.negotiation"));
        // line 9
        yield "<h2>";
        yield t("Goal", []);
        yield "</h2>
<p>";
        // line 10
        yield t("Configure the methods used to decide which language will be used to display text on your site.", []);
        yield "</p>
<h2>";
        // line 11
        yield t("What is a language detection method?", []);
        yield "</h2>
<p>";
        // line 12
        yield t("A language detection method is a way for your site to decide what language should be used to display text. This decision is made by evaluating a series of detection methods for languages; the first detection method that gets a result will determine which language is used. If you have more than one language on your site, you can configure the detection methods that are used and the order they are evaluated, for both user interface text and content text. Configuration text always uses the interface text method, and most sites use the same detection methods for all types of text.", []);
        yield "</p>
<h2>";
        // line 13
        yield t("What language detection methods are available?", []);
        yield "</h2>
<p>";
        // line 14
        yield t("The available detection methods depend on what modules you have installed. Some of the most commonly-used language detection methods are:", []);
        yield "</p>
<dl>
  <dt>";
        // line 16
        yield t("URL", []);
        yield "</dt>
  <dd>";
        // line 17
        yield t("Use the language from the URL, which can either be in a path prefix like <em>example.com/fr/page_path</em> for French (fr) language, or in a domain like <em>fr.example.com/page_path</em>.", []);
        yield "</dd>
  <dt>";
        // line 18
        yield t("User", []);
        yield "</dt>
  <dd>";
        // line 19
        yield t("For logged in users, use the language they have set in their profiles.", []);
        yield "</dd>
  <dt>";
        // line 20
        yield t("Browser", []);
        yield "</dt>
  <dd>";
        // line 21
        yield t("Use the language preferences from the user\x27s browser.", []);
        yield "</dd>
  <dt>";
        // line 22
        yield t("Selected language", []);
        yield "</dt>
  <dd>";
        // line 23
        yield t("Use the language most recently selected from a <em>Language switcher</em> block.", []);
        yield "</dd>
  <dt>";
        // line 24
        yield t("Session", []);
        yield "</dt>
  <dd>";
        // line 25
        yield t("Use the language from a session parameter or a request parameter; for example, adding <em>?language=fr</em> to the end of the URL.", []);
        yield "</dd>
</dl>
<h2>";
        // line 27
        yield t("Steps", []);
        yield "</h2>
<ol>
    <li>";
        // line 29
        yield t("In the <em>Manage</em> administrative menu, navigate to <em>Configuration</em> &gt; <em>Region and language</em> &gt; <em>Languages</em> &gt; @detection_link.", ["@detection_link" => $this->env->getExtension(\Drupal\Core\Template\TwigExtension::class)->renderVar(($context["detection_link"] ?? null)), ]);
        yield "</li>
    <li>";
        // line 30
        yield t("Check the boxes to enable the desired language detection methods, and uncheck boxes for the methods you do not want to use.", []);
        yield "</li>
    <li>";
        // line 31
        yield t("Drag the methods to change their order, if desired.", []);
        yield "</li>
    <li>";
        // line 32
        yield t("Click <em>Save settings</em>.", []);
        yield "</li>
    <li>";
        // line 33
        yield t("Click <em>Configure</em> on each enabled detection method and verify that its configuration is correct (or update the configuration if not).", []);
        yield "</li>
</ol>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@help_topics/language.detect.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  138 => 33,  134 => 32,  130 => 31,  126 => 30,  122 => 29,  117 => 27,  112 => 25,  108 => 24,  104 => 23,  100 => 22,  96 => 21,  92 => 20,  88 => 19,  84 => 18,  80 => 17,  76 => 16,  71 => 14,  67 => 13,  63 => 12,  59 => 11,  55 => 10,  50 => 9,  48 => 8,  43 => 7,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "@help_topics/language.detect.html.twig", "/var/www/html/web/core/modules/language/help_topics/language.detect.html.twig");
    }
    
    public function ensureSecurityChecked(): void
    {
        if ($this->sandbox->isSandboxed($this->source)) {
            $this->checkSecurity();
        }
    }
    
    public function checkSecurity()
    {
        static $tags = ["set" => 7, "trans" => 7];
        static $filters = ["escape" => 29];
        static $functions = ["render_var" => 8, "help_route_link" => 8];

        try {
            $this->sandbox->checkSecurity(
                [0 => "set", 1 => "trans"],
                [0 => "escape"],
                [0 => "render_var", 1 => "help_route_link"],
                $this->source
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
