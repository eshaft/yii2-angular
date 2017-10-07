import {AfterViewInit, ChangeDetectorRef, Component, OnInit} from '@angular/core';
import {HttpClient, HttpHeaders, HttpParams} from "@angular/common/http";
import {Observable} from "rxjs/Rx";
import {Subject} from "rxjs/Subject";
import {User} from "./user/user";
import {UserService} from "./user/user.service";
import {LoginService} from "./login/login.service";

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
      private loginService: LoginService
      ) { }

  ngOnInit() {
      this.loginService.isLogin.subscribe((res: boolean) => this.isLogin = res);
      this.loginService.currentUser.subscribe((user: User) => this.username = user.username);
  }
}