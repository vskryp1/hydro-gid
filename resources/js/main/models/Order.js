import Model from '../../Model';

export default class Order extends Model{

    constructor(obj = {}) {
        super();

        this.hidden = ['from_address', 'to_address'];

        this.values = {
            name: obj.name || '',
            no_matter_where: obj.no_matter_where || 0,
            url: obj.url || '',
            price: obj.price || '',
            quantity: obj.quantity || '',
            description: obj.description || '',
            image_files: [],

            from_address: null,
            to_address: null,

            from_obj: null,
            to_obj: null,

            waiting_time: obj.waiting_time || '',
        }

        this.rules = {
            name: 'required|max:100',
            url: {required: true, url: {require_protocol: true}},
            price: 'required',
            quantity: 'required',
            description: 'required',
            image_files: 'required',

            from_address: 'required',
            to_address: 'required',
            waiting_time: 'required',
        };
    }
}
