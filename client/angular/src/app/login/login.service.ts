import { Injectable } from '@angular/core';
import {Subject} from "rxjs/Subject";
import {User} from "../user/user";
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs/Observable";
import {BehaviorSubject} from "rxjs/BehaviorSubject";

@Injectable()
export class LoginService {
  currentUser: Subject<User> = new Subject();
  isSignIn: BehaviorSubject<boolean> = new BehaviorSubject(false);

  constructor(private httpClient: HttpClient) { }

  signIn(body): Observable<any> {
      return this.httpClient.post('http://frontend.local/login/sign-in', body);
  }
}
