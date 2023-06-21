import Model from '../../Model';

export default class Register extends Model{

    constructor(obj = {}) {
        super();

        this.values = {
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
        }

        this.rules = {
            name: 'required|max:100',
            email: 'required|email|max:100',
            password: 'required|min:6|max:100',
            password_confirmation: 'required|confirmed:password'
        };
    }
}
