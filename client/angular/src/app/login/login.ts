export class Login {
    username: string;
    password: string;
    rememberMe: boolean;

    constructor() {
        this.rememberMe = true;
        this.username = '';
        this.password = '';
    }
}