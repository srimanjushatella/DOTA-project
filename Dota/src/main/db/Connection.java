package main.db;

import org.bson.Document;

import com.mongodb.MongoClient;
import com.mongodb.client.MongoCollection;
import com.mongodb.client.MongoDatabase;

public class Connection {
	

	
	public MongoDatabase getConnections() {
		
		MongoClient mongoClient = new MongoClient( "localhost" , 27017 );
		MongoDatabase database = mongoClient.getDatabase("dota");
		MongoCollection<Document> collection = database.getCollection("heros");
		return database;
	}
	
	

}
