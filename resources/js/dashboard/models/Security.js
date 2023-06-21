import Model from '../../Model';

export default class Security extends Model{

    constructor(obj = {}) {
        super();

        this.hidden = []
        this.values = {
            old_password: obj.old_password || '',
            password: obj.password || '',
            password_confirmation: obj.password || '',
        }

        this.rules = {
            old_password: 'required|min:6',
            password: 'required|min:6|max:100',
            password_confirmation: 'required|confirmed:password'
        };
    }
}
