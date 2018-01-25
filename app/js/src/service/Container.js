import UserLoaderService from '@/service/user/UserLoaderService';

export default class Container {
    constructor() {
        this._userLoaderService = null;
    }

    get userLoaderService() {
        if (this._userLoaderService === null) {
            this._userLoaderService = new UserLoaderService();
        }
        return this._userLoaderService;
    }
}
