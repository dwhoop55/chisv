import api from "@/api.js";

export default {
    can: function (ability, model, id = null, onModel = null, onId = null) {
        return new Promise(function (resolve, reject) {
            api.can(ability, model, id, onModel, onId)
                .then(data => { resolve(data.data.result) })
                .catch(error => { reject(error) })
        });
    }

}