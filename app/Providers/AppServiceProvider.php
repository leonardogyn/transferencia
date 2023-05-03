<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Repositories\BaseRepository;
use App\Http\Repositories\Interfaces\BaseRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Base
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);

        // TypeUser
        $this->app->bind(\Modules\TypeUser\Repositories\Interfaces\TypeUsersRepositoryInterface::class, \Modules\TypeUser\Repositories\TypeUsersRepository::class);
        $this->app->bind(\Modules\TypeUser\Services\Interfaces\TypeUsersServiceInterface::class, \Modules\TypeUser\Services\TypeUsersService::class);

        // User
        $this->app->bind(\Modules\User\Repositories\Interfaces\UserRepositoryInterface::class, \Modules\User\Repositories\UserRepository::class);
        $this->app->bind(\Modules\User\Services\Interfaces\UserServiceInterface::class, \Modules\User\Services\UserService::class);

        // Account
        $this->app->bind(\Modules\Account\Repositories\Interfaces\AccountRepositoryInterface::class, \Modules\Account\Repositories\AccountRepository::class);
        $this->app->bind(\Modules\Account\Services\Interfaces\AccountServiceInterface::class, \Modules\Account\Services\AccountService::class);

        // Transfer
        $this->app->bind(\Modules\Transfer\Repositories\Interfaces\TransferRepositoryInterface::class, \Modules\Transfer\Repositories\TransferRepository::class);
        $this->app->bind(\Modules\Transfer\Services\Interfaces\TransferServiceInterface::class, \Modules\Transfer\Services\TransferService::class);

        // TransferHistory
        $this->app->bind(\Modules\TransferHistory\Repositories\Interfaces\TransferHistoryRepositoryInterface::class, \Modules\TransferHistory\Repositories\TransferHistoryRepository::class);
        $this->app->bind(\Modules\TransferHistory\Services\Interfaces\TransferHistoryServiceInterface::class, \Modules\TransferHistory\Services\TransferHistoryService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
