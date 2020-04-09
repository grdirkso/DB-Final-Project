import java.sql.*;
import java.util.Properties;
import java.util.Scanner;
import java.text.DecimalFormat;
public class HW5 {
	private Connection connection;
	private Statement statement;
	
	public HW5() {
		connection = null;
		statement = null;
	}

	public static void main(String[] args) throws Exception{
		String Username="grdirkso";
		String Password="G#Dirk$o223";
		HW5 db = new HW5();
		db.connect(Username, Password);
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
