<?php

namespace App\Controller;

use App\Entity\DataRow;
use App\Entity\EncryptionKey;
use App\Model\DataRowModel;
use App\Model\EncryptionKeyModel;
use App\Service\EncryptionKeyManager;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class EncryptionKeyController extends AbstractJsonController
{
    /** @var EncryptionKeyManager */
    private $encryptionKeyManager;

    public function __construct(EncryptionKeyManager $encryptionKeyManager)
    {
        $this->encryptionKeyManager = $encryptionKeyManager;
    }

    /**
     * @Route("/encryption-key/list", name="encryption_key_index", methods={"GET"})
     */
    public function index()
    {
        return $this->json($this->encryptionKeyManager->getList());
    }

    /**
     * @Route("/encryption-key/create", name="encryption_key_create", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function create(Request $request)
    {
        $encryptionKeyModel = new EncryptionKeyModel();
        $encryptionKeyModel->setName($request->get('name'));
        $encryptionKeyModel->setHash($request->get('hash'));
        $encryptionKeyModel->setAlgorithm($request->get('algorithm'));
        $encryptionKeyModel->setIterations($request->get('iterations'));

        $this->encryptionKeyManager->create($encryptionKeyModel, $this->getUser());

        return $this->json($encryptionKeyModel);
    }

}
