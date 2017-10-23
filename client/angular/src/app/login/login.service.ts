import {Injectable, OnInit} from '@angular/core';
import {User} from "../user/user";
import {HttpClient, HttpHeaders} from "@angular/common/http";
import {Observable} from "rxjs/Observable";
import {BehaviorSubject} from "rxjs/BehaviorSubject";
import {Router} from "@angular/router";

@Injectable()
export class LoginService implements OnInit {
  currentUser: BehaviorSubject<User> = new BehaviorSubject(new User());
  isLogin: BehaviorSubject<boolean> = new BehaviorSubject(false);

  constructor(private httpClient: HttpClient, private router: Router) {}

  ngOnInit() {}

  logout(){
      localStorage.removeItem('auth_key');
      this.currentUser.next(new User());
      this.isLogin.next(false);
      this.router.navigate(['/']);
  }

  loginByForm(body): Observable<any> {
      return this.httpClient.post('https://frontend.local/login/login-by-form', body);
  }

  signUp(body): Observable<any> {
        return this.httpClient.post('https://frontend.local/login/signup', body);
  }

  requestPasswordReset(body): Observable<any> {
      return this.httpClient.post('https://frontend.local/login/request-password-reset', body);
  }

  resetPasswordPost(token, body): Observable<any> {
      return this.httpClient
          .post('https://frontend.local/login/reset-password?token='+token, body);
  }

  resetPasswordGet(token): Observable<any> {
      return this.httpClient
          .get('https://frontend.local/login/reset-password?token='+token);
  }

  loginByAuthKey(){
      if(!this.getAuthKey()) {
          return;
      }
      const auth_key = this.getAuthKey();
      const headers = new HttpHeaders()
        .set('Authorization', 'Bearer ' + auth_key);
      const options = {headers: headers};

      this.httpClient.post('https://frontend.local/login/login-by-auth-key',
          {auth_key: auth_key}, options
          ).subscribe(
          (user: any) => {
              this.currentUser.next(user.user);
              this.isLogin.next(true);
          },
          err => {
              console.log(err);
          }
      );
  }

  setAuthKey(auth_key){
      localStorage.setItem('auth_key', auth_key);
  }

  getAuthKey(){
      if(!localStorage.auth_key) {
          return false;
      }
      return localStorage.getItem('auth_key');
  }
}
