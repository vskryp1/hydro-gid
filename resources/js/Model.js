import {objectToForm} from "object-to-form";
import axios from "axios";

export default class Model {

    constructor(path = null) {
        this.path = path;
        this.values = {};
        this.hidden = [];
    }

    makeId(length = 9){
        let result = '';
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        const charactersLength = characters.length;
        for (let i = 0; i < length; i++ ) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }

    getData(obj = {}){
        let data = {};
        for (const [key, value] of Object.entries(obj)) {
            data[key] = value;
        }
        for (const [key, value] of Object.entries(this.values)) {
            if (!this.hidden.includes(key) && value !== undefined){
                data[key] = value;
            }
        }
        return objectToForm(data);
    }

    clear(){
        for (const [key, value] of Object.entries(this.values)) {
            this.values[key] = Array.isArray(value)? []: null
        }
    }

    create(path){
        return axios.post( path || this.path+'create', this.getData())
    }
    draft(path){
        return axios.post(path || this.path+'draft', this.getData())
    }
    update(path){
        return axios.post(path || this.path+'update/'+this.values.id, this.getData({_method: 'PUT'}))
    }
    destroy(path){
        return axios.delete(path || this.path+'destroy/'+this.values.id)
    }

}
