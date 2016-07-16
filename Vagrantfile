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

    config.vm.define :default do |main|

        # Every Vagrant virtual environment requires a box to build off of.
        main.vm.box = "ubuntu/trusty64"

        # Configure the hostname of the box
        main.vm.hostname = hostname

        # Configure a private network adapter
        main.vm.network "private_network", ip: local_ip

        # And set the aliases to be used by the vagrant hostupdate plugin (see https://github.com/cogitatio/vagrant-hostsupdater)
        main.hostsupdater.aliases = [hostname]

        if Vagrant::Util::Platform.windows?
            # config.vm.synced_folder ".", "/vagrant", type: "rsync"
            config.vm.synced_folder ".", "/vagrant", :owner => "vagrant", :group => "www-data"
        else
            config.vm.synced_folder ".", "/vagrant", type: "nfs"
        end

        # configure the VirtualBox-Provider (see http://docs.vagrantup.com/v2/virtualbox/configuration.html)
        main.vm.provider "virtualbox" do |vb|

            # enable or disable gui - false means headless
            # vb.gui = true

            # Name the Machine - this ist what will be displayed in the VirtualBox-Management-Gui
            vb.name  = "V-#{project_group}-#{project_name}-#{local_ip}-#{Time.now.to_i}"

            # Customize any other parameters
            vb.customize [
                'modifyvm', :id,
                '--memory', '512',
                '--cpus',   '1',
                '--paravirtprovider',    'kvm',  # use KVM for para-virtualization
                '--ioapic',              'on',   # enable I/O APIC in order to have multiple CPUs available in the guest
                '--natdnsproxy1',        'on',
                '--natdnshostresolver1', 'on',
            ]
        end

        ####  PROVISION  ###############################################################################################

        main.vm.provision "shell", path: ".provision/provision.sh"

        ####  HOST-NAME-ALIASES  #######################################################################################

        main.hostsupdater.aliases = %W(
            frontend.#{hostname}
        )

    end

end
