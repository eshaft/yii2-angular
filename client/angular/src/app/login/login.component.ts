import {Component, OnInit} from '@angular/core';
import {Login} from "./login";
import {HttpClient} from "@angular/common/http";
import {User} from "../user/user";
import {Subject} from "rxjs/Subject";
import {LoginService} from "./login.service";

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
  login: Login = new Login;
  isSignIn: boolean = false;

  constructor(private loginService: LoginService) { }

  ngOnInit() {
    this.loginService.isSignIn.subscribe((res: boolean) => this.isSignIn = res);
  }

  signIn() {
      const body = {LoginForm: {username: this.login.username, password: this.login.password}};
      this.loginService.signIn(body)
          .subscribe(
              (user: User) => {
                  this.loginService.currentUser.next(user);
                  this.loginService.isSignIn.next(true);
              },
              err => {
                  this.loginService.isSignIn.next(false);
              }
          );
  }
}
