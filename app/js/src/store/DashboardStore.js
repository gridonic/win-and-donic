import User from '@/entity/User';

export default class DashboardStore {
    constructor({ userLoaderService }) {
        this.userLoaderService = userLoaderService;

        this.players = [];
        this.players.push(new User({ id: 1, username: 'Gak' }));
    }

    loadPlayers() {
        return this.userLoaderService.loadAllUsersAsync();
    }
}
