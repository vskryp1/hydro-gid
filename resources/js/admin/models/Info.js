import Model from '../../Model';

export default class Info extends Model{

    constructor(obj = {}) {
        super();

        this.hidden = ['id', 'avatar']
        this.values = {
            id: obj.id || null,
            name: obj.name || '',
            email: obj.email || '',
            avatar: obj.avatar || '',
            role_id: obj.role_id || '',
            upload_file: obj.upload_file || undefined,

            password: obj.password || '',
            password_confirmation: obj.password_confirmation || ''
        }

        this.rules = {
            name: 'required|max:100',
            email: 'required|email|max:100',
            role_id: 'required',
            upload_file: this.values.id? 'image|size:2048': 'required|image|size:2048',
            password: 'required|min:6|max:100',
            password_confirmation: 'required|confirmed:password'
        };
    }
}
