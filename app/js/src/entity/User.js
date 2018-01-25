export default class User {
    /**
     * @param {object} data
     */
    constructor(data) {
        this.id = data.id || null;
        this.username = data.username || null;
    }
}
