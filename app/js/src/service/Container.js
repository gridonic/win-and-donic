import AjaxService from '@/service/common/AjaxService';
import UserLoaderService from '@/service/user/UserLoaderService';

export default class Container {
    constructor() {
        this._ajaxService = null;
        this._userLoaderService = null;
    }

    get ajaxService() {
        if (this._ajaxService === null) {
            this._ajaxService = new AjaxService();
        }
        return this._ajaxService;
    }

    get userLoaderService() {
        if (this._userLoaderService === null) {
            this._userLoaderService = new UserLoaderService({ ajaxService: this.ajaxService });
        }
        return this._userLoaderService;
    }
}
