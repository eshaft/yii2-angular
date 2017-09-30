import {Component, OnInit} from '@angular/core';
import {Login} from "./login";
import {HttpClient} from "@angular/common/http";

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
  login: Login = new Login;

  constructor(private httpClient: HttpClient) { }

  ngOnInit() {
  }

  signIn() {
    const body = {LoginForm: {username: this.login.username, password: this.login.password}};
    this.httpClient.post('http://frontend.local/login/sign-in', body)
        .subscribe(
            r => console.log(r),
            r => console.log(r)
        );
  }
}
