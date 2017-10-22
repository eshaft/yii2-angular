export class Alert {
    id: number;
    type: string;
    message: string;

    constructor(config) {
        this.id = config.id;
        this.type = config.type;
        this.message = config.message;
    }
}