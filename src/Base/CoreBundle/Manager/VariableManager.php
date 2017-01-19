<?php

namespace Base\CoreBundle\Manager;

use Base\CoreBundle\Entity\Variable;
use Doctrine\Bundle\DoctrineBundle\Registry;

/**
 * Class SeoManager
 * @package Base\CoreBundle\Manager
 * @author Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class VariableManager
{
    /**
     * @var Registry
     */
    private $doctrine;

    /**
     * @var array
     */
    private $variables = array();

    public function setDoctrine(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function get($name, $default = null)
    {
        $this->sync();
        if (array_key_exists($name, $this->variables)) {
            return $this->variables[$name];
        }
        return $default;
    }

    public function set($name, $value)
    {
        $this->sync();
        if (array_key_exists($name, $this->variables)) {
            $variable = $this->getDoctrineManager()->getRepository('BaseCoreBundle:Variable')->findOneBy([
                'name' => $name,
            ]);
        }
        else {
            $variable = new Variable();
            $variable->setName($name);
            $this->getDoctrineManager()->persist($variable);
        }
        $this->variables[$name] = $value;
        $variable->setValue($value);
        $this->getDoctrineManager()->flush();
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager|object
     */
    private function getDoctrineManager()
    {
        return $this->doctrine->getManager();
    }


    private function sync($force = false)
    {
        static $sync = false;
        if (!$sync || $force) {
            $variables = $this->getDoctrineManager()->getRepository('BaseCoreBundle:Variable')->findAll();
            foreach ($variables as $variable) {
                $this->variables[$variable->getName()] = $variable->getValue();
            }
            $sync = true;
        }
    }
}