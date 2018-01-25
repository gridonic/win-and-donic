import User from '@/entity/User';

export default class UserLoaderService {
    constructor({
        ajaxService
    }) {
        this.ajaxService = ajaxService;
    }

    async loadAllUsersAsync() {
        // TODO: try catch
        const response = await this.ajaxService.get('/api/v1/user/all');
        return this.usersFromData(response.data);
    }

    usersFromData(usersData) {
        // TODO: check if data correct: e.g. array
        return usersData.map(userData => this.userFromData(userData));
    }

    userFromData(userData) {
        // TODO: check if data correct for user
        return new User(userData);
    }
}
