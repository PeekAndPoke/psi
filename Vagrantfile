# -*- mode: ruby -*-
# vi: set ft=ruby :

require 'pp'

# RECOMMENDED Vagrant Plugin to be installed
#
# vagrant plugin install vagrant-hostsupdater
# vagrant plugin install vagrant-vbguest

user = ENV['USER']

project_name  = "psi"
project_group = "peekandpoke"
hostname      = "#{project_name.downcase}.#{project_group.downcase}.local"
local_ip      = "192.168.56.101"

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

    config.vm.define :default do |default_config|

        # Every Vagrant virtual environment requires a box to build off of.
        default_config.vm.box = "ubuntu/trusty64"

        # Configure the hostname of the box
        default_config.vm.hostname = hostname

        # Configure a private network adapter
        default_config.vm.network "private_network", ip: local_ip

        # And set the aliases to be used by the vagrant hostupdate plugin (see https://github.com/cogitatio/vagrant-hostsupdater)
        default_config.hostsupdater.aliases = [hostname]

        # Set username and password to use,
        # This is needed since we specify a non-default ssh-key below. Vagrant needs to log in using these credentials
        # TODO: is this really necessary and can we change the password?
        default_config.ssh.username = "vagrant"
        default_config.ssh.password = "vagrant"

        # using local users ssh key inside the box and agent forwarding to have local ssh key active, f.e. to avoid github rate limit
        default_config.ssh.private_key_path = "~/.ssh/id_rsa"
        default_config.ssh.forward_agent = true

        if Vagrant::Util::Platform.windows?
            # config.vm.synced_folder ".", "/vagrant", type: "rsync"
            config.vm.synced_folder ".", "/vagrant", :owner => "vagrant", :group => "www-data"
        else
            config.vm.synced_folder ".", "/vagrant", type: "nfs"
        end

        # configure the VirtualBox-Provider (see http://docs.vagrantup.com/v2/virtualbox/configuration.html)
        default_config.vm.provider "virtualbox" do |vb|

            # enable or disable gui - false means headless
            # vb.gui = true

            # Name the Machine - this ist what will be displayed in the VirtualBox-Management-Gui
            vb.name  = "V-#{project_group}-#{project_name}-#{local_ip}-#{Time.now.to_i}"

            # Customize any other parameters
            vb.customize [
                "modifyvm", :id,
                "--memory", "512",
                "--cpus",   "1"
            ]
        end

        # initial provisioning using Ansible (see http://docs.vagrantup.com/v2/provisioning/ansible.html)

        default_config.vm.provision "shell", path: ".provision/provision.sh"

    end

    config.hostsupdater.aliases = [
        "frontend.#{hostname}"
    ]

    # Disable automatic box update checking. If you disable this, then
    # boxes will only be checked for updates when the user runs
    # `vagrant box outdated`. This is not recommended.
    # config.vm.box_check_update = false

    # Create a forwarded port mapping which allows access to a specific port
    # within the machine from a port on the host machine. In the example below,
    # accessing "localhost:8080" will access port 80 on the guest machine.
    # config.vm.network "forwarded_port", guest: 80, host: 8080

    # Create a private network, which allows host-only access to the machine
    # using a specific IP.
    # config.vm.network "private_network", ip: "192.168.33.10"

    # Create a public network, which generally matched to bridged network.
    # Bridged networks make the machine appear as another physical device on
    # your network.
    # config.vm.network "public_network"

    # Share an additional folder to the guest VM. The first argument is
    # the path on the host to the actual folder. The second argument is
    # the path on the guest to mount the folder. And the optional third
    # argument is a set of non-required options.
    # config.vm.synced_folder "../data", "/vagrant_data"

end
