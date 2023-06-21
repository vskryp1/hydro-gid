import Model from '../../Model';

export default class Trip extends Model{

    constructor(obj = {}) {
        super();

        this.hidden = ['from_address', 'to_address'];

        this.values = {
            date: obj.date || '',
            dates: obj.dates || [],
            round_trip: obj.round_trip || 0,

            from_address: obj.from_address || '',
            to_address: obj.to_address || '',

            from_obj: null,
            to_obj: null,
        }

        this.rules = {
            from_address: 'required',
            to_address: 'required',
            date: 'required',
            dates: 'required'
        };
    }
}
