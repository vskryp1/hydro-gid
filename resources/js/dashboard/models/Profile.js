import Model from '../../Model';

export default class Profile extends Model{

    constructor(obj = {}) {
        super();

        this.hidden = ['id']
        this.values = {
            id: obj.id || null,
            name: obj.name || '',
            email: obj.email || '',
            phone: obj.phone || '',
            address: obj.address || '',
            country_id: obj.country_id || '',
        }

        this.rules = {
            name: 'required|max:100',
            email: 'required|email|max:100',
            phone: 'required|min:9|max:100',
            country_id: 'required',
            address: 'required',
        };
    }
}
