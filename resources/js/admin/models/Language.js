import Model from '../../Model';

export default class Language extends Model{

    constructor(obj = {}) {
        super();

        this.hidden = ['id']
        this.values = {
            id: obj.id || null,
            country_id: obj.country_id || '',
            name: obj.name || '',
            code: obj.code || '',
            default: obj.default || 0,
            right_direction: obj.right_direction || 0
        }

        this.rules = {
            country_id: 'required',
            name: 'required|max:100',
            code: 'required|max:2',
        };
    }
}
