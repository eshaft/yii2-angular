import { Component } from '@angular/core';
import {HttpClient, HttpHeaders, HttpParams} from "@angular/common/http";
import {Observable} from "rxjs/Rx";
import {Subject} from "rxjs/Subject";
import {User} from "./user/user";

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'app';
  USER_URL: string = 'https://frontend.local/users';
  user: Subject<User> = new Subject();

  constructor(private httpClient: HttpClient) {
      this.getUserById(1).subscribe(
          (user) => {
            console.log(user);
            this.user.next(user);
          },
          (error) => console.log(error)
      );

      this.user.subscribe(user => console.log(user));

      const obs = Observable.interval(1000);

      obs.take(3).subscribe(v => console.log('1. '+v));
      obs.take(5).subscribe(v => console.log('2. '+v));
  }

  public getUsers(url: string): Observable<any>{
      const options = {params: new HttpParams().set('access-token', '5DBx6qjvcIqx8j1wSlij__3lWDRLwzr5')};
      return this.httpClient.get(url, options);
  }

  public getUserById(id: number): Observable<User>{
      const url = this.USER_URL + '/' + id;
      const params = new HttpParams().set('access-token', '5DBx6qjvcIqx8j1wSlij__3lWDRLwzr5');
      //const headers = new HttpHeaders().set('Authorization', 'Bearer 5DBx6qjvcIqx8j1wSlij__3lWDRLwzr5');
      return this.httpClient.get(url, {params: params})
  }
}