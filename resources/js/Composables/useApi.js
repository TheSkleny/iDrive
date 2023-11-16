import axios from "axios";

/**
 *
 * @param method {'GET' | 'POST' | 'PUT' | 'PATCH' | 'DELETE'}
 * @param url {String}
 * @param data {any | null}
 * @param config {axios.AxiosRequestConfig<any> | null}
 * @returns {Promise<{response: axios.AxiosResponse<any>, error: any}>}
 */
export default async (method, url, data = null, config = null) => {

    let response;
    let error;
    switch (method) {
        case 'GET':
            try {
                response = await axios.get(url, config ?? {});
            } catch (e) {
                error = e;
            }
            break;
        case 'POST':
            try {
                response = await axios.post(url, data ?? {}, config ?? {});
            } catch (e) {
                error = e;
            }
            break;
        case 'PUT':
            try {
                response = await axios.put(url, data ?? {}, config ?? {});
            }
            catch (e) {
                error = e;
            }
            break;
        case 'PATCH':
            try {
                response = await axios.patch(url, data ?? {}, config ?? {});
            } catch (e) {
                error = e;
            }
            break;
        case 'DELETE':
            try {
                response = await axios.delete(url, config ?? {});
            } catch (e) {
                error = e;
            }
            break;
        default:
            throw new Error('Invalid method');
    }
    return { response, error };

}
