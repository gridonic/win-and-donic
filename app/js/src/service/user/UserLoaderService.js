import axios from 'axios';

import User from '@/entity/User';

export default class UserLoaderService {
    loadAllUsersAsync() {
        return axios
            .get('/api/v1/user/all')
            .then(response => this.usersFromData(response.data));
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
