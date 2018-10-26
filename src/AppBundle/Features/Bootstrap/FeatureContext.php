<?php

namespace AppBundle\Features\Bootstrap;

use AppBundle\Entity\Admin;
use AppBundle\Entity\Language;
use AppBundle\Entity\ModuleList;
use AppBundle\Entity\Settings;
use AppBundle\Features\Context\DefaultContext;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends DefaultContext implements Context, SnippetAcceptingContext
{

    private $container;
    private $em;


    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct($container,$entityManager)
    {
        $this->container = $container;
        $this->em = $entityManager;
    }

    public function loadFixtures()
    {
        $admin = new Admin();
        $admin->setEmail('admin@admin.admin')->setUser('Worldlex')
            ->setPassword('o3q9qGaT7KXg7jnNGUP+mxDOv8L3sZtdkqMVSyoPdzj1y7s0Ge8+TgHGMYHzkKaNMfGS8U42gxOpOFLOdG0pyQ==')
            ->setSalt('f8c749a5f42797b9db46c3d3860087e7')->setPermissions(0);

        $this->em->persist($admin);

        $setting = new Settings();
        $setting->setName('maintenance')->setValue(2);
        $this->em->persist($setting);
        $setting = new Settings();
        $setting->setName('global-message-active')->setValue(0);
        $this->em->persist($setting);
        $setting = new Settings();
        $setting->setName('global-message-text')->setValue('');
        $this->em->persist($setting);
        $setting = new Settings();
        $setting->setName('global-gcl-message-active')->setValue(0);
        $this->em->persist($setting);
        $setting = new Settings();
        $setting->setName('global-gcl-message-text')->setValue('');
        $this->em->persist($setting);
        $lang = new Language();
        $lang->setName('Español')->setSlug('es')->setActive(1);
        $this->em->persist($lang);
        $gcl = new ModuleList();
        $gcl->setName('Gestor de Cumplimiento Legal')->setCode('LegalCompliance')->setPermissions('0:Administrador;1:Gestor Completo;2:Gestor Limitado;');
        $this->em->persist($gcl);


        $this->em->flush();
    }

    /**
     * @Given I reset the database
     */
    public function clearData()
    {
        $application = new Application($this->container->get('kernel'));
        $application->setAutoExit(false);
        $options = array('command' => 'doctrine:schema:drop', '--force' => true);
        $application->run(new ArrayInput($options));
        $options = array('command' => 'doctrine:schema:create','--force');
        $application->run(new ArrayInput($options));
//        $this->loadFixtures();
    }

    /**
     * @When I login as :arg1 with password :arg2
     */
    public function iLogin($arg1,$arg2)
    {
        $this->iFillInTheFollowing('username',$arg1);
        $this->iFillInTheFollowing('password',$arg2);
        $this->iPress('btn-login');
    }

    /**
     * @When I click on the link :arg1
     */
    public function iClickOnTheLink($link)
    {
        $this->clickLink($link);
    }

    /**
     * @When I fill the input :arg1 with :arg2
     */
    public function iFillInTheFollowing($key,$value)
    {
        $this->fillField($key, $value);
    }

    /**
     * @Given I am on :arg1
     */
    public function iAmOn($arg1)
    {
        $this->visitPath($arg1);
    }

    /**
     * @Then I click on the input :arg1
     */
    public function iClickOnTheInput($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then I should see :arg1
     */
    public function iShouldSee($arg1)
    {
        $this->assertSession()->pageTextContains($this->fixStepArgument($arg1));
    }

    /**
     * @When I press :arg1
     */
    public function iPress($arg1)
    {
        $this->pressButton($arg1);
    }

    /**
     * @Then stop :arg1 miliseconds
     */
    public function stop($arg1)
    {
        $this->getSession()->wait($arg1);
    }

    /**
     * @Then I select value :arg1 from :arg2
     */
    public function iSelect($arg1,$arg2)
    {
        $page = $this->getSession()->getPage();
        $page->selectFieldOption($arg2,$arg1);
    }

    /**
     * @Then I check the :arg1 box
     */
    public function iCheckTheBox($arg1)
    {
         $this->getSession()->getPage()->checkField($arg1);
    }

    /**
     * @Then I should see :arg1 in the :arg2 element
     */
    public function assertElementText($arg1, $arg2) {
//        $page    = $this->getSession()->getPage();
//        $elements = $page->findAll('css', $arg2);

//        $mierder = null;
//        foreach($this->getSession()->getPage()->findAll('css', $arg2) as $element)
//            if (strpos(strtolower($arg1), strtolower($element->getText()) !== false))
//                return $element->getText();
//            else
//                $mierder = $element->getText();

        $this->assertSession()->elementContains('css',$arg2,$arg1);

//        throw new \Exception("Text '$arg1' is not found in the '$arg2' element. -> $mierder");
    }
}
