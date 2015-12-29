<?php

namespace Base\AdminBundle\Controller;

use \DateTime;

use JMS\SecurityExtraBundle\Annotation\Secure;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * LockController class.
 *
 * \@extends Controller
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 *
 * @Route("/lock")
 */
class LockController extends Controller
{

    private static $entityMapper = array(
        'newsarticle' => 'NewsArticle'
    );

    /**
     * createLockAction function.
     *
     * @access public
     * @param mixed $slug
     * @return void
     *
     * @Secure(roles="ROLE_ADMIN")
     * @Route("/create/{id}", options={"expose"=true})
     */
    public function createLockAction(Request $request, $id)
    {
        $entity = $request->get('entity');
        $locale = $request->get('locale');
        $logger = $this->get('logger');
        $em = $this->get('doctrine')->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $response = new JsonResponse();

        if ($entity == null || $id == null || $locale == null) {
            $logger->error(__CLASS__. " - Couldnt create the lock for entity '{$entity}' id '{$id}' locale '{$locale}', parameter id or entity missing");
            $response->setStatusCode(400);
            return $response->setData(array(
                'message' => 'Impossible de créer le verrou.'
            ));
        }

        if (!isset(self::$entityMapper[$entity])) {
            $logger->error(__CLASS__. " - Couldnt create the lock for the entity '{$entity}', entity not found in the entityMapper");
            $response->setStatusCode(400);
            return $response->setData(array(
                'message' => 'Impossible de créer le verrou.'
            ));
        }

        $entity = $em->getRepository('BaseCoreBundle:'. self::$entityMapper[$entity])->findOneById($id);
        if ($entity === null) {
            $logger->error(__CLASS__. " - Couldnt create the lock for entity ". self::$entityMapper[$entity]. " id '{$id}' locale '{$locale}', id not found");
            $response->setStatusCode(400);
            return $response->setData(array(
                'message' => 'Impossible de créer le verrou.'
            ));
        }

        $trans = $entity->findTranslationByLocale($locale);
        if ($trans === null) {
            $logger->error(__CLASS__. " - Couldnt create the lock for entity ". self::$entityMapper[$entity]. " id '{$id}' locale '{$locale}', translation not found");
            $response->setStatusCode(400);
            return $response->setData(array(
                'message' => 'Impossible de créer le verrou.'
            ));
        }

        $trans->setLockedBy($user);
        $trans->setLockedAt(new DateTime());
        $em->flush();

        $response->setData(array(
            'message' => 'Verrou crée'
        ));

        return $response;
    }

    /**
     * hasLockAction function.
     *
     * @access public
     * @param mixed $slug
     * @return void
     *
     * @Secure(roles="ROLE_ADMIN")
     * @Route("/has_lock/{id}", options={"expose"=true})
     */
    public function hasLockAction(Request $request, $id)
    {
        $entity = $request->get('entity');
        $locale = $request->get('locale');
        $logger = $this->get('logger');
        $em = $this->get('doctrine')->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $response = new JsonResponse();

        if ($entity == null || $id == null || $locale == null) {
            $logger->error(__CLASS__. " - Couldnt verify the lock for entity '{$entity}' id '{$id}' locale '{$locale}', parameter id or entity missing");
            $response->setStatusCode(400);
            return $response->setData(array(
                'message' => 'Impossible de vérifier l\'existence du verrou.'
            ));
        }

        if (!isset(self::$entityMapper[$entity])) {
            $logger->error(__CLASS__. " - Couldnt verify the lock for the entity '{$entity}', entity not found in the entityMapper");
            $response->setStatusCode(400);
            return $response->setData(array(
                'message' => 'Impossible de vérifier l\'existence du verrou.'
            ));
        }

        $entity = $em->getRepository('BaseCoreBundle:'. self::$entityMapper[$entity])->findOneById($id);
        if ($entity === null) {
            $logger->error(__CLASS__. " - Couldnt verify the lock for entity ". self::$entityMapper[$entity]. " id '{$id}' locale '{$locale}', id not found");
            $response->setStatusCode(400);
            return $response->setData(array(
                'message' => 'Impossible de vérifier l\'existence du verrou.'
            ));
        }

        $trans = $entity->findTranslationByLocale($locale);
        if ($trans === null) {
            $logger->error(__CLASS__. " - Couldnt verify the lock for entity ". self::$entityMapper[$entity]. " id '{$id}' locale '{$locale}', translation not found");
            $response->setStatusCode(400);
            return $response->setData(array(
                'message' => 'Impossible de vérifier l\'existence du verrou.'
            ));
        }

        $response->setData(array(
            'locked' => ($trans->getLockedBy() !== null) ? true : false
        ));

        return $response;
    }

    /**
     * deleteLockAction function.
     *
     * @access public
     * @param mixed $slug
     * @return void
     *
     * @Secure(roles="ROLE_ADMIN")
     * @Route("/delete/{id}", options={"expose"=true})
     */
    public function deleteLockAction(Request $request, $id)
    {
        $entity = $request->get('entity');
        $locale = $request->get('locale');
        $logger = $this->get('logger');
        $em = $this->get('doctrine')->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $response = new JsonResponse();

        if ($entity == null || $id == null || $locale == null) {
            $logger->error(__CLASS__. " - Couldnt create the lock for entity '{$entity}' id '{$id}' locale '{$locale}', parameter id or entity missing");
            $response->setStatusCode(400);
            return $response->setData(array(
                'message' => 'Impossible de supprimer le verrou.'
            ));
        }

        if (!isset(self::$entityMapper[$entity])) {
            $logger->error(__CLASS__. " - Couldnt create the lock for the entity '{$entity}', entity not found in the entityMapper");
            $response->setStatusCode(400);
            return $response->setData(array(
                'message' => 'Impossible de supprimer le verrou.'
            ));
        }

        $entity = $em->getRepository('BaseCoreBundle:'. self::$entityMapper[$entity])->findOneById($id);
        if ($entity === null) {
            $logger->error(__CLASS__. " - Couldnt create the lock for entity ". self::$entityMapper[$entity]. " id '{$id}' locale '{$locale}', id not found");
            $response->setStatusCode(400);
            return $response->setData(array(
                'message' => 'Impossible de supprimer le verrou.'
            ));
        }

        $trans = $entity->findTranslationByLocale($locale);
        if ($trans === null) {
            $logger->error(__CLASS__. " - Couldnt create the lock for entity ". self::$entityMapper[$entity]. " id '{$id}' locale '{$locale}', translation not found");
            $response->setStatusCode(400);
            return $response->setData(array(
                'message' => 'Impossible de supprimer le verrou.'
            ));
        }

        $trans->setLockedBy(null);
        $trans->setLockedAt(null);
        $em->flush();

        $response->setData(array(
            'message' => 'Verrou supprimé'
        ));

        return $response;
    }
}