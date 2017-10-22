import {Component, OnInit} from '@angular/core';
import {User} from "./user/user";
import {LoginService} from "./login/login.service";
import {AlertService} from "./alert.service";

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit {
    brand = 'Yii2-Angular4-Bootstrap4';
    username: string;
    isLogin: boolean = false;

    constructor(
      private loginService: LoginService,
      public alertService: AlertService
    ) { }

    ngOnInit() {
        this.loginService.loginByAuthKey();
        this.loginService.isLogin
            .subscribe((res: boolean) => this.isLogin = res);
        this.loginService.currentUser
            .subscribe((user: User) => this.username = user.username);
    }
}