import java.sql.*;
import java.util.Properties;
import java.util.Scanner;
import java.text.DecimalFormat;
public class final {
	private Connection connection;
	private Statement statement;
	
	public final() {
		connection = null;
		statement = null;
	}

	public static void main(String[] args) throws Exception{
		String Username="grdirkso";
		String Password="G#Dirk$o223!";
		final db = new final();
		db.connect(Username, Password);
		db.menu();
	}

	public void connect(String Username, String mysqlPassword) throws Exception {
        try {
	  Class.forName("com.mysql.jdbc.Driver"); 	
	  connection = DriverManager.getConnection("jdbc:mysql://localhost/" + Username + "?user=" + Username + "&password=" + mysqlPassword);
        }
        catch (Exception e) {
            System.out.println("error");
		throw e;
        }
    }
}	
