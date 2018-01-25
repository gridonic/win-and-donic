import axios from 'axios';

export default class AjaxService {
    get(requestUrl) {
        return axios.get(requestUrl);
    }
}
