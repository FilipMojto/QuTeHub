from flask import Flask, render_template, request, redirect, url_for, flash, session
from dotenv import load_dotenv
import os
from werkzeug.security import generate_password_hash, check_password_hash
from flask_sqlalchemy import SQLAlchemy

# Load environment variables
load_dotenv()

app = Flask(__name__)
app.secret_key = 'K82kk_U81Kd-D92/>!@md?'

app.config['SQLALCHEMY_DATABASE_URI'] = (
    f"postgresql+psycopg2://{os.getenv('DB_USER')}:{os.getenv('DB_PASSWORD')}@"
    f"{os.getenv('DB_HOST')}:{os.getenv('DB_PORT')}/{os.getenv('DB_NAME')}"
)
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False

db = SQLAlchemy(app)

class Users(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    username = db.Column(db.String(150), unique=True, nullable=False)
    password = db.Column(db.String(150), nullable=False)


@app.route('/')
def default():
    return redirect(url_for('home'))

@app.route('/register', methods=['GET', 'POST'])
def register():
    if request.method == 'POST':
        username = request.form['register-panel-username']
        password = request.form['register-panel-password']
        retype_password = request.form['register-panel-retype_password']

        if password != retype_password:
            flash('Passwords do not match!', 'danger')
            return redirect(url_for('register'))

        # Check if username already exists
        existing_user = Users.query.filter_by(username=username).first()
        if existing_user:
            flash('Username already exists.<br> Please choose a different username.', 'danger')
            return redirect(url_for('register'))
        

        hashed_password = generate_password_hash(password=password, method=os.getenv('HASHING_ALGORITHM'))
        new_user = Users(username=username, password=hashed_password)

        db.session.add(new_user)
        db.session.commit()

        flash('Registration successful! You can now log in.', 'success')
        return redirect(url_for('login'))

    username_pattern = os.getenv('USERNAME_PATTERN')
    password_pattern = os.getenv('PASSWORD_PATTERN')
    return render_template('register_view.html', username_pattern=username_pattern, password_pattern=password_pattern)



@app.route('/login', methods=['GET', 'POST'])
def login():
    if request.method == 'POST':
        username = request.form['login-panel-username']
        password = request.form['login-panel-password']
        user = Users.query.filter_by(username=username).first()
        
    
        if user and check_password_hash(user.password, password):
            session['username'] = user.username
            # flash('You have successfully logged in!', 'success')
            return redirect(url_for('home'))
        else:
            flash('Login Unsuccessful. Please check your username and password', 'danger')
            return redirect(url_for('login'))

    username_pattern = os.getenv('USERNAME_PATTERN')
    password_pattern = os.getenv('PASSWORD_PATTERN')
    return render_template('login_view.html', username_pattern=username_pattern, password_pattern=password_pattern)

@app.route('/check-login', methods=['GET'])
def check_login():
    if 'username' in session:
        return redirect(url_for('load_account_panel'))
    else:
        return redirect(url_for('login'))

@app.route('/account-details', methods=['GET'])
def load_account_panel():

    return render_template('account_panel.html')    

@app.route('/home', methods=['GET'])
def home():
    return render_template('home.html')

@app.route('/logout')
def logout():
    session.pop('username', None)
    flash('You have successfully logged out!', 'success')
    return redirect(url_for('login'))



if __name__ == "__main__":
    with app.app_context():
        db.create_all()

    app.run(debug=True)