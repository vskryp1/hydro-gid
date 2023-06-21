import Model from '../../Model';

export default class Setting extends Model{

    constructor(obj = {}) {
        super();

        this.hidden = ['id']
        this.values = {
            id: obj.id || null,
            payment_system_commission: obj.payment_system_commission || '',
            esco_commission: obj.esco_commission || '',
        }

        this.rules = {
            payment_system_commission: 'required|numeric|max_value:100',
            esco_commission: 'required|numeric|max_value:100'
        };
    }
}
