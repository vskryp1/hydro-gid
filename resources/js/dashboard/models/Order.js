import Model from '../../Model';

export default class Order extends Model{

    constructor(obj = {}) {
        super();

        this.hidden = ['id', 'images', 'from_address', 'to_address'];

        this.values = {
            id: obj.id || null,
            name: obj.name || '',
            no_matter_where: obj.no_matter_where || 0,
            url: obj.url || '',
            price: obj.price || '',
            quantity: obj.quantity || '',
            description: obj.description || '',
            images: obj.images || [],
            image_files: [],
            image_deletes: [],

            address_from: obj.from_location? obj.from_location.address: '',
            address_to: obj.to_location? obj.to_location.address: '',

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

            address_from: 'required',
            address_to: 'required',
            waiting_time: 'required',
        };
    }
}
