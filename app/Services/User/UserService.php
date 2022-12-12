<?php

namespace App\Services\User;

use App\Repositories\User\UserReponsitory;
use App\Repositories\User\UserRepositoryInterface;
use App\Traits\RenderPagination;

class UserService implements UserServiceInterface
{
    use RenderPagination;
   /**
     * @var $userRepository
     * @var $sendMailService
     */
    protected $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function getListAdminUser($perPage, $page)
    {
        $results = $this->userRepository->getPaginateSortId($perPage, $page, ["*"]);

        return $this->renderPagination($results, function ($value) {
            return $this->renderAdminUser($value);
        });
    }

    /**
     * @param $adminUser
     *
     * @return array
     */
    public function renderAdminUser($adminUser)
    {
        return [
            'id' => $adminUser->id,
            'name' => $adminUser->name,
            'hospital_name' => $adminUser->hospital_name,
            'is_admin' => $adminUser->is_admin
        ];
    }

        /**
     * @param App\Http\Requests\RegisterUserRequest $request
     *
     * @return bool
     */
    public function registerUser($request)
    {
        DB::beginTransaction();
        try {
            $dataRegisterUser = $request->only(['email']);
            /** Check User Exist */
            $checkUserExist = $this->checkUserExist($dataRegisterUser);
            // if ($checkUserExist) {
                $user = $checkUserExist;
                /** Reset User Verify */
                $checkUserExist->update(['email_verified_at' => null]);
            // } else {
            //     $checkUserDeleted = $this->checkUserDeleted($dataRegisterUser);

            //     if($checkUserDeleted) {
            //         Log::info('User registration with deleted user #ID: ' . $checkUserDeleted->id ?? '');
            //         $checkUserDeleted->userDetailWithTrashed()->forceDelete();
            //         $checkUserDeleted->favoriteHospital()->delete();
            //         $checkUserDeleted->wipRemindConfig()->delete();
            //         $checkUserDeleted->pushNotificationDelivery()->delete();
            //         $checkUserDeleted->registrationTokens()->delete();
            //         $checkUserDeleted->forceDelete();
            //     }

            //     $user = $this->userRepository->create(
            //         $dataRegisterUser
            //     );
            // }

            // $checkToken = $this->checkTokenDeviceExists($request->device_token);
            // if ($checkToken) {
            //     /** Push noti and send mail verify */
            //     /** Push notification */
            //     $pushNoti = $this->pushNotificationService->sendCreateUser($user, $request->device_token);
            //     if (!$pushNoti->hasFailures()) {
            //         /** Send mail verify */
            //         $user->sendEmailVerificationNotification();
            //     } else {
            //         DB::rollBack();
            //         return false;
            //     }
            // } else {
            //     /** Only send mail verify */
            //     $user->sendEmailVerificationNotification();
            // }

            DB::commit();
            return true;

        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            return false;
        }

    }

    /**
     * @param  string $deviceToken
     * @return bool
     */
    function checkTokenDeviceExists($deviceToken) {
        if (!empty($deviceToken)) {
            return true;
        }

        return false;
    }
}
