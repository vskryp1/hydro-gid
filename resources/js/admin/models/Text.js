import Model from '../../Model';

export default class Text extends Model{

    constructor(obj = {}, languages) {
        super();

        this.hidden = ['id']
        this.values = {
            id: obj.id || null,
            key: obj.key || '',
            texts: [],
        }

        this.rules = {
            key: 'required|max:100',
            texts: 'required'
        };

        this.setTexts(obj, languages)
    }

    setTexts(obj, languages){
        languages.forEach(l => this.values.texts.push({language_id: l.id, text: null}));
        if (obj.texts){
            obj.texts.forEach(t => {
                let find = this.values.texts.find(i => t.language_id === i.language_id);
                if (find){
                    find.text = t.text;
                }
            })
        }
    }
}
