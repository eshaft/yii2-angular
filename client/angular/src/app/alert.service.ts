import {Injectable, OnDestroy} from '@angular/core';
import {Alert} from "./alert";

@Injectable()
export class AlertService {

  constructor() { }

    setAlert(type: string, message: string){
      if(localStorage.alert) {
        let alerts: Alert[] = this.getAlerts();
        let id = alerts.length + 1;
        alerts.push(new Alert({id:id, type:type, message:message}));
        localStorage.setItem('alert', JSON.stringify(alerts));
      } else {
        localStorage.setItem('alert', JSON.stringify([
            new Alert({id:1, type:type, message:message})
        ]));
      }

    }

    getAlerts(): Alert[] {
        if(this.has()) {
            return JSON.parse(localStorage.getItem('alert'));
        } else {
            return [];
        }

    }

    has(): boolean {
        return localStorage.alert;
    }

    closeAlert(alert: Alert) {
        let alerts = this.getAlerts();
        const index: number = alerts.indexOf(alert);
        alerts.splice(index, 1);
        this.setAlerts(alerts);
    }

    private setAlerts(alerts){
        localStorage.setItem('alert', JSON.stringify(alerts));
    }

}
