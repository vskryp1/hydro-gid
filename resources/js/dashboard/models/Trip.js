import Model from '../../Model';

export default class Trip extends Model{

    constructor(obj = {}) {
        super();

        this.hidden = ['id', 'from_address', 'to_address'];

        this.values = {
            id: obj.id || null,
            from_obj: obj.from_obj || null,
            to_obj: obj.from_obj || null,
            from_address: obj.from_location? obj.from_location.address: '',
            to_address: obj.to_location? obj.to_location.address: '',
            date: obj.date || '',
            dates: obj.dates || [],
            round_trip: obj.round_trip || 0
        }

        this.rules = {
            from_address: 'required',
            to_address: 'required',
            date: 'required',
            dates: 'required'
        };
    }
}
