<?php

namespace App\Controller;

use App\Entity\DataRow;
use App\Model\DataRowModel;
use App\Service\DataManager;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class DataController extends AbstractJsonController
{
    /** @var DataManager */
    private $dataManager;

    public function __construct(DataManager $dataManager)
    {
        $this->dataManager = $dataManager;
    }

    /**
     * @Route("/data", name="data_index", methods={"GET"})
     */
    public function index()
    {
        return $this->json($this->dataManager->getList($this->getUser()));
    }

    /**
     * @Route("/data/create", name="data_create", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function create(Request $request)
    {
        $dataRowModel = new DataRowModel();
        $dataRowModel->setName($request->get('name'));
        $dataRowModel->setLogin($request->get('login', ''));
        $dataRowModel->setComment($request->get('comment', ''));

        $this->dataManager->create($dataRowModel, $this->getUser());

        return $this->json($dataRowModel);
    }

    /**
     * @Route("/data/{id}/update", name="data_update", methods={"POST"})
     * @param Request $request
     * @param DataRow $dataRow
     * @return JsonResponse
     * @throws Exception
     */
    public function update(Request $request, DataRow $dataRow)
    {
        $dataRowModel = new DataRowModel();
        $dataRowModel->setName($request->get('name'));
        $dataRowModel->setLogin($request->get('login', ''));
        $dataRowModel->setComment($request->get('comment', ''));

        $this->dataManager->update($dataRow, $dataRowModel, $this->getUser());

        return $this->json(true);
    }

    /**
     * @Route("/data/{id}/delete", name="data_delete", methods={"POST"})
     * @param DataRow $dataRow
     * @return JsonResponse
     */
    public function delete(DataRow $dataRow)
    {
        $this->dataManager->delete($dataRow, $this->getUser());

        return $this->json(true);
    }

    /**
     * @Route("/data/{id}/get-password", name="data_get_password", methods={"GET"})
     * @param DataRow $dataRow
     * @return JsonResponse
     */
    public function getPassword(DataRow $dataRow)
    {
        $password = $this->dataManager->getPassword($dataRow, $this->getUser());
        return $this->json($password);
    }

    /**
     * @Route("/data/{id}/set-password", name="data_set_password", methods={"POST"})
     * @param Request $request
     * @param DataRow $dataRow
     * @return JsonResponse
     */
    public function setPassword(Request $request, DataRow $dataRow)
    {
        $password = $request->get('password');
        $encryptionKeyId = $request->get('encryptionKeyId');
        $this->dataManager->setPassword($dataRow, $password, $encryptionKeyId, $this->getUser());

        return $this->json(true);
    }

    /**
     * @Route("/data/{id}/get-recovery-info", name="data_get_recovery_info", methods={"GET"})
     * @param DataRow $dataRow
     * @return JsonResponse
     */
    public function getRecoveryInfo(DataRow $dataRow)
    {
        $recoveryInfo = $this->dataManager->getRecoveryInfo($dataRow, $this->getUser());
        return $this->json($recoveryInfo);
    }

    /**
     * @Route("/data/{id}/set-recovery-info", name="data_set_recovery_info", methods={"POST"})
     * @param Request $request
     * @param DataRow $dataRow
     * @return JsonResponse
     */
    public function setRecoveryInfo(Request $request, DataRow $dataRow)
    {
        $recoveryInfo = $request->get('recoveryInfo');
        $encryptionKeyId = $request->get('encryptionKeyId');
        $this->dataManager->setRecoveryInfo($dataRow, $recoveryInfo, $encryptionKeyId, $this->getUser());

        return $this->json(true);
    }

}
