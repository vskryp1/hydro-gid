import Model from '../../Model';

export default class News extends Model{

    constructor(obj = {}) {
        super();

        this.hidden = ['id', 'image'];

        this.values = {
            id: obj.id || null,
            image: obj.image || '',
            image_file: obj.image_file || '',
            langs: obj.langs || {},
        }

        this.rules = {
            image_file: this.values.id ? 'image|size:2048': 'required|image|size:2048',
            langs: '',
        };
    }
}
