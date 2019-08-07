import axios from '@/plugins/axios.js'

export default {

    emailLink(data) {
        return axios.post('password/email', data)
    },

    resetPassword(data) {
        return axios.post('password/reset', data)
    },

}