import {Injectable, OnInit} from '@angular/core';
import {User} from "../user/user";
import {HttpClient, HttpHeaders} from "@angular/common/http";
import {Observable} from "rxjs/Observable";
import {BehaviorSubject} from "rxjs/BehaviorSubject";

@Injectable()
export class LoginService implements OnInit {
  currentUser: BehaviorSubject<User> = new BehaviorSubject(new User());
  isLogin: BehaviorSubject<boolean> = new BehaviorSubject(false);

  constructor(private httpClient: HttpClient) { }

  ngOnInit() {}

  login(body): Observable<any> {
      const headers = new HttpHeaders()
          .set('Authorization', 'Bearer 5DBx6qjvcIqx8j1wSlij__3lWDRLwzr5');
      const options = {headers: headers};
      return this.httpClient.post('http://frontend.local/login/login', body, options);
  }

}
