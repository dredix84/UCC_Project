package com.twilio;

import java.util.HashMap;
import java.util.Map;

import com.twilio.sdk.TwilioRestClient;
import com.twilio.sdk.TwilioRestException;
import com.twilio.sdk.TwilioRestResponse;
import com.twilio.sdk.resource.factory.SmsFactory;
import com.twilio.sdk.resource.instance.Account;
import com.twilio.sdk.resource.instance.Sms;


public class SendNotifications {
    /* Twilio REST API version */
    public static final String ACCOUNTSID = "XXXXXXXXXXXXXXXXX";
    public static final String AUTHTOKEN = "XXXXXXXXXXXXXXXXX";
    
    public static void main(String args[]){
    	
        /* Instantiate a new Twilio Rest Client */
        TwilioRestClient client = new TwilioRestClient(ACCOUNTSID, AUTHTOKEN);

        // Get the account and call factory class
        Account acct = client.getAccount();
        SmsFactory smsFactory = acct.getSmsFactory();

        //build map of server admins
        Map<String,String> admins = new HashMap<String,String>();
        admins.put("4158675309", "Johnny");
        admins.put("4158675310", "Helen");
        admins.put("4158675311", "Virgil");
       
        String fromNumber = "YYY-YYY-YYYY";

    	// Iterate over all our server admins
        for (String toNumber : admins.keySet()) {
            
            //build map of post parameters 
            Map<String,String> params = new HashMap<String,String>();
            params.put("From", fromNumber);
            params.put("To", toNumber);
            params.put("Body", "Bad news " + admins.get(toNumber) + ", the server is down and it needs your help");

            try {
                // send an sms a call  
                // ( This makes a POST request to the SMS/Messages resource)
                Sms sms = smsFactory.create(params);
                System.out.println("Success sending SMS: " + sms.getSid());
            }
            catch (TwilioRestException e) {
                e.printStackTrace();
            }
        }
    }       
}
