import Model from '../../Model';

export default class Login extends Model{

    constructor(obj = {}) {
        super();

        this.values = {
            email: '',
            password: ''
        }

        this.rules = {
            email: 'required|email',
            password: 'required|min:6'
        };
    }
}
